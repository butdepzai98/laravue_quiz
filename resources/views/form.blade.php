<h1 align="center">Form Test POST & PUT</h1>

<div align="center">
    <form action="/user/81" method="post">
        @csrf
        @method('put')

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<h1 align="center">Delete Test</h1>

<div align="center">
    <form action="/delete/81" method="post">
        @csrf
        @method('delete')

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<h1 align="center">Method Options Test</h1>

<div align="center">
    <form action="/options" method="post">
        @csrf
        @method('options')

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<h1 align="center">Get Route by Route->name : </h1>
<div class="list-group">
    <a href="{{ route('show.name', ['name'=>"Link 1", 'cate'=> 1]) }}" class="list-group-item list-group-item-action">Link 1</a>
    <a href="{{ route('show.name', ['name'=>"Link 2", 'cate'=> 2]) }}" class="list-group-item list-group-item-action">Link 2</a>
    <a href="{{ route('show.name', ['name'=>"Link 3", 'cate'=> 3]) }}" class="list-group-item list-group-item-action">Link 3</a>
</div>