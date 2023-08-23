



   <h1 class="text-center">Add Stock Managing Team</h1>



   <form action="{{ route('TTeam.store') }}" method="POST">


           @csrf

           <div class="row mb-3">
               <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

               <div class="col-md-6">
                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                   @error('name')
                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                   @enderror
               </div>
           </div>


           <div class="row mb-3">
               <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

               <div class="col-md-6">
                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                   @error('email')
                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                   @enderror
               </div>
           </div>

           <div class="row mb-3">
               <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

               <div class="col-md-6">
                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >

                   @error('password')
                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                   @enderror
               </div>


           </div>
       <div class="row mb-3">
           <label for="name" class="col-md-4 col-form-label text-md-end"></label>

           <div class="col-md-6">
               <input id="name" type="number" class="form-control @error('name') is-invalid @enderror" name="role" placeholder="role" value="0" required autocomplete="name" hidden>

               @error('name')
               <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
               @enderror
           </div>
       </div>

       <div class="col-xs-12 col-sm-12 col-md-12 text-center">
               <button type="submit" class="btn btn-primary">Submit</button>
           </div>



   </form>


