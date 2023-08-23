



   <h1>Add Category</h1>



   <form action="{{ route('ImageCategory.store') }}" method="POST">

   @csrf

       <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                   <strong>Category type:</strong>
                   <input type="text" name="type" class="form-control" placeholder="Name">
               </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-md-12 text-center"><br>
               <button type="submit" class="btn btn-primary">Submit</button>
           </div>
       </div>


   </form>


