@extends('adminlte::page')

<!-- @section('title', 'Dashboard') -->

@section('content')
<div ng-controller="itemsController">
    <section class="content-header">
        <h1>Items &nbsp; <span><button ng-click="toggle('new_item', categories[0].items[0])" class="btn btn-xs btn-success btn-flat">new</button></span></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Items</li>
        </ol>
    </section>    

    @include('adminlte::partials.alert')

    <!-- Main content -->
    <section class="content">
        <span us-spinner="{radius:6, width:2, length:5}"></span>
        <div class="box" ng-repeat="category in categories | orderBy:'name'">
            <div class="box-header with-border">
              <h3 class="box-title pointer">
                <span class="badge"><% category.items.length %></span>
                <span data-widget="collapse"><% category.name %></span>
              </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" ng-click="toggle('modify_category', category.items[0])"><i class="fa fa-edit"></i></button>
                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Barcode</th>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in category.items | orderBy:'name' | filter:search">
                            <td ng-click="toggle('item', item)"><% item.name %></td>
                            <td ng-click="toggle('item', item)"><% item.description %></td>
                            <td ng-click="toggle('item_code', item)"><% code(item.item_codes, 'Barcode').code %></td>
                        </tr>
                    </tbody>
                        
                </table>
            </div> 
        </div>  
    </section>
    <!-- /.content -->
    <!-- Modal (Pop up when detail button clicked) -->
    <div class="modal fade" id="inventoryModal" tabindex="-1" role="dialog" aria-labelledby="inventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="inventoryModalLabel"><% modal.title %></h4>
                </div>
                <div class="modal-body">
                    <form name="items" class="form-horizontal" novalidate="" class="ng-textbox">
                        <datalist ng-if="modal['array']['category']" id="category">
                            <option ng-repeat="data in modal['array']['category'] | orderBy:'name'" value="<% data.name %>">
                        </datalist>   
                        <div class="form-group error" ng-repeat="(field, label) in modal.field" >
                            <label for="name" class="col-sm-3 control-label"><% label %></label>
                            <div class="col-sm-9">
                                <input type="text" 
                                    class="form-control has-error" 
                                    id="<% field %>"
                                    list="<% field %>" 
                                    name="<% field %>" 
                                    placeholder="<% label %>" 
                                    ng-model="modal['data'][field]" 
                                    ng-required="true">
                                <span class="help-inline" 
                                    ng-show="modal['data'][field].$invalid && modal['data'][field].$touched">
                                    <% label %> field is required</span>    
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" ng-click="update(modal.data)" ng-disabled="modal.data.$invalid"><% modal.button %></button>
                </div>
            </div>
        </div>
    </div>
</div>    

@stop

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <style>
        .pointer, td { cursor:pointer; }
        .table>tbody+tbody {
            border-top: none; 
        }
    </style>
@stop

@section('js')
   <script src="{{ asset('app/controllers/items.js') }}"></script>
@stop

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                /*height: 100vh;*/
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 5px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a.active {
                color: rgba(255, 0, 0, .7);
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            table {
                width: 100%;
                margin-top: 20px;

            }
            table th, table td {
                border: 1px solid #eee;
                color: #000 !important;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ReStore Inventory
                </div>

                <div class="links">
                    @foreach ($status as $s)
                        <a href="{{ url('items') }}/{{$s->id}}" class="{{ $s->id===(int)$id ? 'active' : '' }}">{{ $s->name }}</a>
                    @endforeach
                </div>

                <div>
                    <table>
                        <thead>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Market Price</th>
                            <th>Barcode</th>
                            <th>Donor</th>
                        </thead>
                        @foreach($status->find($id)->inventories as $inventory)
                            <tr>
                                <td>{{$inventory->item->name}}</td>
                                <td>{{$inventory->quantity}}</td>
                                <td>{{$inventory->itemPrices->first()->market_price}}</td>
                                <td>{{$inventory->item->itemCodes->last()->code}}</td>
                                <td>{{$inventory->donors->first()->name}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>    

            </div>
        </div>
    </body>
</html>
