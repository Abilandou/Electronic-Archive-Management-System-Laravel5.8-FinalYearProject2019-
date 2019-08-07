@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-1 col-xs-1 col-xl-1 col-md-1">@include('snippets.sidebar')</div>
        <div class="col-sm-11 col-xs-11 col-xl-11 col-md-11 ">
            <h5 class="mt-4"><i><b>Editing...:  </b></i><b class="teal-text"></b></h5>
            <div class="divider"></div>
            <div class="card hoverable mr-4 ">
                <form action="{{ url('edit-category/') }} "  class="col-s-12" method="POST">

                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="form-group">
                            <i class="material-icons prefix">house</i>
                            <label for="name">Category Name</label>
                            <input type="text"
                                   name="name"
                                   required
                                   class="validate"
                                   id="category_name"
                                   value=""
                            />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn float-right my-2">Save </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
