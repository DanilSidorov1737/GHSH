@extends('layouts.master')

@section('content')


<main id="main" class="main">

<div class="pagetitle">
  <h1>Repos</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

  

    

        <!-- Recent Sales -->
        <div class="col-12">
          
              <div class="card">
  <div class="card-header">
  @if ($repo){{ $repo->name }} <span>| {{ $repo->owner_name }}</span>   @endif
  </div>
  <div class="card-body">
    <table class="table table-borderless">
      <thead>
        <tr>
          <th>File Name</th>
        </tr>
       
      </thead>
      <tbody>
        @foreach($files as $file)
        <tr>
          <td><li><a href="{{ asset('storage/' . $file->pathname) }}" target="_blank">{{ $file->name }}</a></li></td>
          <td></td>
          <td></td>
          <td style="width: 40%;"></td>
          <td style="width: 40%;"></td>
          
          <td><button class="btn btn-danger">Edit</button></td>
          <td>
            <form action="{{ route('files.destroy', $file->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

              
<!-- A button to open the popup form -->
<button class="open-button" onclick="openForm()">Add</button>

<!-- The form -->


<div class="form-popup" id="myForm">
  <form action="{{ route('repos.add', ['repo_name' => $repo->name]) }}" enctype="multipart/form-data" method="post" class="form-container">
                @csrf
    <h1>Add More Files</h1>
    <input type="hidden" name="repo_name" value="{{ $repo->name }}" />
    <input type="file" id="file-input" multiple name="files[]"/>
                    <label for="file-input">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
        
                    </label>
                <div id="num-of-files">No Files Choosen</div>
                <ul id="files-list"></ul>

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<style>
    {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

<script>
    function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

let fileInput = document.getElementById("file-input");
let fileList = document.getElementById("files-list");
let numOfFiles = document.getElementById("num-of-files");
fileInput.addEventListener("change", () => {
  fileList.innerHTML = "";
  numOfFiles.textContent = `${fileInput.files.length} Files Selected`;
  for (i of fileInput.files) {
    let reader = new FileReader();
    let listItem = document.createElement("li");
    let fileName = i.name;
    let fileSize = (i.size / 1024).toFixed(1);
    listItem.innerHTML = `<p>${fileName}</p><p>${fileSize}KB</p>`;
    if (fileSize >= 1024) {
      fileSize = (fileSize / 1024).toFixed(1);
      listItem.innerHTML = `<p>${fileName}</p><p>${fileSize}MB</p>`;
    }
    fileList.appendChild(listItem);
  }
});

</script>
         
      
</div>
</section>




                

</main><!-- End #main -->
@endsection
