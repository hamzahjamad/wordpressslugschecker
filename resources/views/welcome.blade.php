@extends('layout.master')
@section('content')
          {!! Form::open(['url' => 'slugchecker', 'method' => 'post']) !!}

          @if (session('slugchecker_errors'))
              <div class="control notification is-danger">
                <button class="delete"></button>
                  {{ session('slugchecker_errors') }}
              </div>
          @endif

          @if (count($errors) > 0)
                <div class="control notification is-danger">
                  <button class="delete"></button>
                   <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

               <label class="label">
                  Blogger ID* 
                  <a href="http://blogtimenow.com/blogging/find-blogger-blog-id-post-id-unique-id-number/"><span class="icon"><i class="fa fa-question-circle"></i></span></a>
               </label>
                  
                <p class="control">
                  <input class="input" name="blogger_id" type="text" value="1746070298135901032" placeholder="Your Blogger ID">
                </p>
                
                <label class="label">
                  Wordpress URL*
                </label>
                <p class="control">
                  <input class="input" name="wordpress_url" type="text" value="hundred-pages.dev" placeholder="Your Wordpress URL">
                </p>

                <label class="label">
                  Wordpress Basic Token (Optional)
                  <a href="https://code.tutsplus.com/tutorials/wp-rest-api-setting-up-and-using-basic-authentication--cms-24762"><span class="icon"><i class="fa fa-question-circle"></i></span></a>
                </label>
                <p class="control">
                  <input class="input" name="wordpress_token" type="text" placeholder="Your Wordpress Basic Token">
                </p>

                 <p class="control">
                  <label class="checkbox">
                    <input type="checkbox" name="wordpress_fix">
                    Automatically fix the slugs (Require Wordpress Token).
                  </label>
                </p>

                <div class="control">
                  <p class="control">
                    <button type="submit" class="button is-primary">Submit</button>
                  </p>
                </div>

                <div class="control notification">
                    <p class="control">
                        After submitting the form, please wait around 10 to 15 minutes for the server to process it.
                    </p>
                </div>

                <div class="control notification">
                    <p class="control">
                        Fixing the slug automatically only working on Apache server , and please enable the server to accept Authorization Basic header first.
                        <a href="https://github.com/WP-API/Basic-Auth/issues/1"><span class="icon"><i class="fa fa-question-circle"></i></span></a>
                    </p>
                </div>

          {!! Form::close() !!}

@endsection          