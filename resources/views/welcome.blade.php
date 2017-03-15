@extends('layout.master')
@section('content')
    <form method="POST" action="/slugchecker" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
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
                  <input class="input" name="blogger_id" v-model="blogger_id" type="text" placeholder="Your Blogger ID">
                  <span class="help is-danger" v-if="errors.has('blogger_id')" v-text="errors.get('blogger_id')"></span>
                </p>
                
                <label class="label">
                  Wordpress URL*
                </label>
                <p class="control">
                  <input class="input" name="wordpress_url" v-model="wordpress_url" type="text" placeholder="Your Wordpress URL">
                  <span class="help is-danger" v-if="errors.has('wordpress_url')" v-text="errors.get('wordpress_url')"></span>
                </p>

                <label class="label">
                  Wordpress Basic Token (Optional)
                  <a href="https://code.tutsplus.com/tutorials/wp-rest-api-setting-up-and-using-basic-authentication--cms-24762"><span class="icon"><i class="fa fa-question-circle"></i></span></a>
                </label>
                <p class="control">
                  <input class="input" name="wordpress_token" v-model="wordpress_token" type="text" placeholder="Your Wordpress Basic Token">
                   <span class="help is-danger" v-if="errors.has('blogger_id')" v-text="errors.get('wordpress_token')"></span>
                </p>

                 <p class="control">
                  <label class="checkbox">
                    <input type="checkbox" v-model="wordpress_fix" name="wordpress_fix">
                    Automatically fix the slugs (Require Wordpress Token).
                    <span class="help is-danger" v-if="errors.has('blogger_id')" v-text="errors.get('wordpress_fix')"></span>
                  </label>
                </p>

                <div class="control">
                  <p class="control">
                    <button type="submit" class="button is-primary" :disabled="errors.any()">
                      Submit 
                       <span v-if="show_loading" style="margin-left: 5px;" class="icon"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></span>                
                     </button>
                  </p>
                </div>

                <div class="control notification">
                    <p class="control">
                        After submitting the form, please wait around 10 to 15 minutes for the server to process it.
                    </p>
                </div>

                <div class="control notification">
                    <p class="control">
                        Fixing the slug automatically only working on Apache server. Dont forgot to enable the server to accept Authorization Basic header first.
                        <a href="https://github.com/WP-API/Basic-Auth/issues/1"><span class="icon"><i class="fa fa-question-circle"></i></span></a>
                    </p>
                </div>

</form>

<div v-if="blogger.any()" style="margin-top: 30px;">
@include('result')
</div>

@endsection          