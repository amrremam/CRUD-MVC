<?php


class productController
{
    public function index(){
       $db = new product();
       $data['products'] = $db->getALLproducts();
       view::load('product/index',$data);
    }

//-----ADD-DATA
    public function add(){
        view::load("product/add");
    }
//----STORE-DATA
    public function store(){
        view::load("product/add");
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $this->conn = new Product();
            $dataInsert = Array ( "name" => $name ,
                            "description" => $description ,
                            "price" => $price ,
                            "qty" => $qty 
                            );
        $db = new product();
        if($db->insertProduct($dataInsert))
        {
            view::load("product/add",["success"=>"data created succes"]);
        }
    }
        else
        {
            view::load("product/add");
        }

    }
//-----EDIT---DATA--
    public function edit($id)
    {
        $db = new product();
        if($db->getRow($id))
        {
        $data['row'] = $db->getRow($id);
        view::load("product/edit",$data);
        }
        else{
            echo"error";
        }
    }
//------UPDATE---DATA--
    public function update($id)
    {
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $this->conn = new Product();
            $dataInsert = Array ( "name" => $name ,
                            "description" => $description ,
                            "price" => $price ,
                            "qty" => $qty 
                            );
        $db = new product();
        if($db->updateProduct($id,$dataInsert))
        {
            $data['row'] = $db->getRow($id);
            view::load("product/edit",["success"=>"data updated succes",'row'=> $db->getRow($id)]);
        }
        else
        {
            view::load("product/edit",['row'=>$db->getRow($id)]);
        }
    }

    }
    // }
//-----DELETE--DATA
    public function delete($id)
    {
       $db = new product();
        if($db->deleteProduct($id))
        {
            view::load("product/delete");
        }else{
            echo"error";
        }
    }



}