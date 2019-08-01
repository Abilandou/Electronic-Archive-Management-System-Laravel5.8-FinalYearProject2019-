@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('snippets.sidebar')
    </div>
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">folder</i> Upload Document
          <a href="/documents/create" class="btn waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Upload New Document"><i class="material-icons">file_upload</i> New</a>
        </h3>
        <div class="divider"></div>
      </div>

      <div class="row">
        <div class="col m8 s12">
        <form action="" enctype="multipart/form-data" class="col-s-12" method="post">

            {{ csrf_field() }}
          <div class="card hoverable">
            <div class="card-content">
              <div class="input-field">
                <i class="material-icons prefix">folder</i>
                <label for="name">File Name</label>
                <input type="text" name="file_name" class="validate" id="name">



              </div>
              <br>
              <div class="input-field">
                <i class="material-icons prefix">description</i>
                <textarea name="description" class="validate" id="description"></textarea>
                <label for="description">Description</label>

                  <span class="red-text"><strong></strong></span>

              </div>
              <br>
              <div class="input-field">
                <!-- <input type="checkbox" id="isExpire" name="isExpire" checked/> -->

                <label for="isExpired">
                     <input type="checkbox" id="isExpired">
                <span>Does Not Expire</span>
                </label>

              </div>
              <label>
              <br>
              <div class="input-field">
                <!-- <input type="text" class="datepicker" name="expires_at" id="expirePicker" disabled> -->

                <input id="expirePicker" type="text" class="datepicker" name="">
                <label for="expirePicker">Expires At</label>
              </div>
              <br>
              <div class="input-field">
                <i class="material-icons prefix">class</i>

                <label for="category">Category (Optional)</label>
                <select name="category_id[]" id="category" >
                    <option value="" >Select Category</option>
                    <option value="" >Select Category</option>
                    <option value="" >Select Category</option>

                </select>

                  <span class="red-text"><strong></strong></span>

              </div>
              <br>
              <div class="file-field input-field">
                <div class="btn white">
                  <span class="black-text">Choose </span>
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
              <br>
              <div class="input-field">
                <p class="center">

                  <button class="btn-large waves-effect waves-light">Save </button>
                </p>
              </div>
            </div>
          </div>
          </form>
        </div>
        <div class="col m4 hide-on-med-and-down">
          <div class="card-panel teal">
            <h4>Notice</h4>
            <p>
              <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
              </ul>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
