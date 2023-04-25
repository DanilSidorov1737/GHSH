@extends('layouts.master')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Create your New Repository</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
      <li class="breadcrumb-item active">Create new Repo</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Repo Form</h5>

              

              <!-- Horizontal Form -->
              <form action="/repo/upload" enctype="multipart/form-data" method="post">

              @csrf
                <div class="row mb-3">
                  <label for="repo_name" class="col-sm-2 col-form-label">Repo Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="repo_name">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="repo_name" class="col-sm-2 col-form-label">Repo Description</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="repo_name" class="col-sm-2 col-form-label">Repo Subject</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText">
                  </div>
                </div>
                
                <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0">Public or Private?</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Public
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                      <label class="form-check-label" for="gridRadios2">
                        Private
                      </label>
                    </div>
                   
                  </div>
                </fieldset>
                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1">
                      <label class="form-check-label" for="gridCheck1">
                        Would you Like to add a ReadMe.md?
                      </label>
                    </div>
                  </div>
                </div>

                <input type="file" id="file-input" multiple name="files[]"/>
                    <label for="file-input">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
        
                    </label>
                <div id="num-of-files">No Files Choosen</div>
                <ul id="files-list"></ul>


                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>




<script>

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

</section>

</main><!-- End #main -->

@endsection