@extends('layouts.convenios')
@section('workArea')
<section class="core">
    <!-- <div class="content">
        <div class="card">
            <i class="fa-solid fa-users"></i>
            <b><h4>Usuarios</h4></b>
            <h5>5</h5>
            <br>
            <button type="submit">
                Administrar
            </button>
        </div>
        <div class="card">
            <i class="fa-solid fa-user-shield"></i>
            <b><h4>Roles</h4></b>
            <h5>5</h5>
            <br>
            <button type="submit">
                Administrar
            </button>
        </div>
    </div> -->
</section>
@endsection
@section('css')
<style>
    .card {
        width: fit-content;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        margin-top: 25px;
        padding: 10px;
        background-color: white;
        text-align: center;
    }

    .card:hover{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.4);
    }

    .card i{
        font-size: 75px;
        padding:10px;
        border-radius:50%;
        color: rgb(0,0,0,0.2);
        margin: auto;
    }

    .card button {
    background-color: #fff;
    border: 1px solid #d5d9d9;
    border-radius: 8px;
    box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
    box-sizing: border-box;
    color: #0f1111;
    cursor: pointer;
    display: inline-block;
    font-family: "Amazon Ember",sans-serif;
    font-size: 13px;
    line-height: 29px;
    padding: 0 10px 0 11px;
    position: relative;
    text-align: center;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    width: 100px;
    }

    .card button:hover {
    background-color: #f7fafa;
    }

    .card button:focus {
    border-color: #008296;
    box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
    outline: 0;
    }

</style>
@endsection