<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
      <h3 class="text-white text-center">Simple Laravel 11 CRUD</h3>
    </div>
    <div class="container">
      <div class="row justify-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg my-4">
            <div class="card-header bg-dark">
              <h4 class="text-white">Edit Product</h4>
            </div>
            <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
              @csrf
              @method('put')
              <div class="card-body">
                <div class="mb-3">
                  <label for="name" class="form-label h5">Name:</label>
                  <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" placeholder="Name">
                  @error('name')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="price" class="form-label h5">Price:</label>
                  <input type="text" class="form-control form-control-lg @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" placeholder="Price">
                  @error('price')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label h5">Description:</label>
                  <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                  @error('description')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="image" class="form-label h5">Image:</label>
                  <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" name="image">
                  @if ($product->image)
                  <img src="{{ asset('Uploads/Products/' . $product->image) }}" alt="Product Image" class="w-50 my-3">
                  @endif
                  @error('image')
                  <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn btn-lg btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
