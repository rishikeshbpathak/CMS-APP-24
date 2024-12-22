<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Nested CMS | {{ $page->title }}</title>
</head>
<body>
    <div>
       <h1>{{ $page->title }}</h1>
       <p>{{ $page->content }}</p>
       @if($page->children->isNotEmpty())
           <ul>
               @foreach($page->children as $child)
                   <li><a href="/{{ $url_slug }}/{{ $child->slug }}">{{ $child->title }}</a></li>
               @endforeach
           </ul>
       @endif
       <a href="{{ url()->previous() }}" class="btn btn-primary">Previous</a>
    </div>
</body>
</html>
