<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

#[Title('Productos')]
class ProductComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    //Propiedades de la clase
    public $totalRegistros=0;
    public $search='';
    public $cant=5;
    //Propiedades modelo
    public $name;
    public $Id=0;
    public $category_id;
    public $description;
    public $precio_compra;
    public $precio_venta;
    public $codigo_barras;
    public $stock=10;
    public $stock_minimo=10;
    public $fecha_vencimiento;
    public $active=1;
    public $image;
    public $imageModel;

    
    public function render()
    {
        $this->totalRegistros = Product::count();
        $products = Product::where('name', 'like', '%'.$this->search.'%')
        ->orderBy('id', 'desc') 
        ->paginate($this->cant);
        return view('livewire.product.product-component', [
            'products' => $products
        ]);
    }

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    public function create(){

        $this->Id=0;

        $this->clean();
        
        $this->dispatch('open-modal', 'modalProduct');
    }
    //Crear productos
    public function store(){
        //dd(1);
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories',
            'description' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];
    
    
        $this->validate($rules);

        $product = new Product();
        
        // if($this->image){
        //     $customName = 'products/'.uniqid().'.'.$this->image->extension();
        //     $this->image->storeAs('public', $customName);
        // }

        $product -> name = $this->name;
        $product-> description = $this->description;
        $product-> precio_compra = $this->precio_compra;
        $product-> precio_venta = $this->precio_venta;
        $product-> stock = $this->stock;
        $product-> stock_minimo = $this->stock_minimo;
        $product-> codigo_barras = $this->codigo_barras;
        $product-> fecha_vencimiento = $this->fecha_vencimiento;
        //$product-> image = $this->imageModel;
        $product-> category_id = $this->category_id;
        $product-> active = $this->active;
        $product->save();

        if($this->image){
            $customName = 'products/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs($customName);
            $product->image()->create(['url'=> $customName]);

        }

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto creado correctamente');
        $this->clean();
    }

    public function edit(Product $product){

        $this->clean();
        //$this->reset(['name']);
        $this->Id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->precio_compra = $product->precio_compra;
        $this->precio_venta = $product->precio_venta;
        $this->stock = $product->stock;
        $this->stock_minimo = $product->stock_minimo;
        $this->imageModel = $product->imageModel;
        $this->codigo_barras = $product->codigo_barras;
        $this->fecha_vencimiento = $product->fecha_vencimiento;
        $this->active = $product->active;
        $this->category_id = $product->category_id;

        

        $this->dispatch('open-modal', 'modalProduct');
    }

    public function update(Product $product){
        
        $rules = [
            'name' => 'required|min:5|max:255|unique:products,id,'.$this->Id,
            'description' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];

        $this->validate($rules);

        $product -> name = $this->name;
        $product-> description = $this->description;
        $product-> precio_compra = $this->precio_compra;
        $product-> precio_venta = $this->precio_venta;
        $product-> stock = $this->stock;
        $product-> stock_minimo = $this->stock_minimo;
        //$product-> image = $this->imageModel;
        $product-> codigo_barras = $this->codigo_barras;
        $product-> fecha_vencimiento = $this->fecha_vencimiento;
        $product-> category_id = $this->category_id;
        $product-> active = $this->active;
        $product->update();

        if($this->image){
            if($product->image!=null){
                Storage::delete('public/'.$product->image->url);
                $product->image()->delete();
            }

            
        $customName = 'products/'.uniqid().'.'.$this->image->extension();
        $this->image->storeAs($customName);
        $product->image()->create(['url'=> $customName]);
    
            
        }

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto editado correctamente');

        $this->clean();
    }

    #[On('destroyProduct')]
    public function destriy ($id)
    {

        $product = Product::findOrfail($id);

           if($product->image!=null){//Si el producto contiene imagen también la elimina del servidor
                Storage::delete('public/'.$product->image->url);
                $product->image()->delete();
            }

            $product->delete();

            $this->dispatch('msg', 'Producto eliminado correctamente');
            
    }
    


    //Métdo encargado de la limpieza del modal
    public function clean()
    {
        $this->reset(['Id', 'name', 'image', 'description', 'precio_compra', 'precio_venta', 
        'stock', 'stock_minimo', 'codigo_barras', 'fecha_vencimiento', 'active', 'category_id']);
        $this->resetErrorBag();
    }
}
