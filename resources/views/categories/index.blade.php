@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="section">
            <div class="col m1 hide-on-med-and-down">
                @include('snippets.sidebar')
            </div>
            <div class="col m11 s12">
                @include('snippets.messages')
                <div class="row">

                    <h3 class="flow-text"><i class="material-icons">category</i>Categories
                        <a  href="#" style="margin-left:1000px;">
                            <button id="trigger" title="Add New Category" class="tooltipped btn" data-position="top"  data-delay="50" data-tooltip="Add New Faculty"><i class="material-icons" >add</i>Add New</button>
                        </a>
                    </h3>
                </div>
                <div class="divider"></div>
                <div class="card z-depth-2">
                    <div class="card-content">
                        <table class=" striped bordered centered highlight" id="myDataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    {{--@if(!$category->hasRole('Root')) --}}
                                    <tr class="@if($category->id % 2 == 0)  @else indigo lighten-4 @endif" >
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="categories/{{ $category->id }}/edit" title="Edit Category" class="tooltipped" data-position="right" id="catedit"  data-delay="50" data-tooltip="Edit Category" >
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                            <a href="{{ url('/delete-category/'.$category->id) }}" id="delnow" title="Delete This Category" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This Category" >
                                                <i class="material-icons">delete</i>
                                            </a>

                                        </td>
                                    </tr>
                                    {{--@endif--}}
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"><h5 class="teal-text">No Category has been added</h5></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="right">{{$categories->links('vendor.pagination.materializecss')}}</p>
            </div>
        </div>
    </div>

    <!-- Modal For Adding Faculty -->

    <div class="modal teal">
        <header class="modal-header white-text align-center teal">
            <h4 class="modal-header-text">Add Category</h4><br/>
        </header>
        <div class=" container-fluid  modal-content">

            <div class="container">
                <form method="post" action="{{ url('categories') }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><b>Category Name(required)</b></label>
                        <input type="text"
                               placeholder="Enter Faculty Name"
                               name="name"
                               required
                               id="category_name"
                        >
                    </div>
                    <div class="form-group ">
                        <button type="submit"
                                class=" text-lighten-4 float-right btn mb-3 ">
                            <i class="material-icons" >add</i>Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
