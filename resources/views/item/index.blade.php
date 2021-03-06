@extends('adminlte::page')

@section('title', 'Items')

@section('content')
<div ng-controller="itemsController">
    <section class="content-header">
        <h1>Items <span class="badge" style="cursor: pointer;" ng-click="toggle('new_item', '')" >create</span></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Items</li>
        </ol>
    </section>    

    @include('adminlte::partials.alert')

    <!-- Main content -->
    <section class="content">
        <span us-spinner="{radius:6, width:2, length:5}"></span>
        <div class="box box-solid" ng-repeat="category in categories | orderBy:'name'">
            <div class="box-header with-border">
              <h3 class="box-title pointer">
                <span class="badge"><% category.items.length %></span>
                <span data-widget="collapse"><% category.name %></span>
              </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" ng-click="toggle('modify_category', category.items[0])"><i class="fa fa-edit"></i></button>
                <button class="btn btn-box-tool" ng-click="delete_category(category)"><i class="fa fa-times"></i></button>
                <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <!-- <th>Barcode</th> -->
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in category.items | orderBy:'name' | filter:search">
                            <td><% item.name %></td>
                            <td><% item.description %></td>
                            <td><% item.created %></td>
                            <!-- <td ng-click="toggle('item_code', item)"><% code(item.item_codes, 'Barcode').code %></td> -->
                            <td><i ng-click="toggle('item', item)" class="fa fa-edit"></i>
                                <i ng-click="delete_item(item, category)" class="fa fa-times"></i></td>
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

        