
<nav class="level is-mobile">

  <div v-if="blogger.any()" class="level-item has-text-centered">
    <div>
      <p class="heading">Total Available Slugs</p>
        <p class="title">
          @{{ blogger.getSlug().length }}
      </p>
    </div>
  </div>

  <div v-if="wordpress.any()" class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Not Matched</p>
        <p class="title">
          @{{ wordpress.getSlug().length }}
      </p>
    </div>
  </div>

 <div v-if="fixed.any()" class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Fixed</p>
        <p class="title">
          @{{ fixed.getSlug('fixed').length }}
      </p>
    </div>
  </div>

  <div v-if="fixed.any()" class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Cant Be Fixed</p>
        <p class="title">
        @{{ fixed.getSlug('not_fixed').length }}
      </p>
    </div>
  </div>

</nav>



<div v-if="wordpress.any()">
<hr>
<div class="notification">
  <h3>Total Slugs Not Matched</h3>
</div>
<div class="content">
<p>
  <ol>
      <li v-for="wordpress in wordpress.getSlug()" v-text="wordpress"></li>
  </ol>
</p>
</div>
</div>

<div v-if="fixed.any()">

<hr>
<div class="notification">
  <h3>Total Slugs Fixed</h3>
</div>
<div class="content">
<p>
  <ol>
     <li v-for="slug_fixed in fixed.getSlug('fixed')" v-text="slug_fixed"></li>
  </ol>
</p>
</div>


<hr>
<div class="notification">
  <h3>Total Slugs Cant Be Fixed</h3>
</div>
<div class="content">
<p>
  <ol>
    <li v-for="slug_not_fixed in fixed.getSlug('not_fixed')" v-text="slug_not_fixed"></li>
  </ol>
</p>
</div>

</div>


