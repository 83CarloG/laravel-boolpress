<header>
    <h1 class="text-center text-primary pt-2 pb-2">BLOG CLASSE 17</h1>

    <nav class="navbar navbar-light mb-3" style="background-color: #CCE5CC;">
       <form class="form-inline">
           <div class="raw">
               <a href="{{ route('guest.posts.index') }}">
                    <button class="btn btn-outline-success " type="button">Indice Post</button>
               </a>
                <a href="{{ route('admin.posts.create') }}">
                    <button class="btn btn-outline-success " type="button">Crea Post</button>
               </a>
            </div>
      </form>
    </nav>
</header>

