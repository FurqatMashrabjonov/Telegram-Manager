<h2>Cateogriyalar</h2>

<ul>
    @foreach($categories as $category)
        <li>{{$category->id}} . <strong>{{$category->name}}</strong></li>
    @endforeach
</ul>
