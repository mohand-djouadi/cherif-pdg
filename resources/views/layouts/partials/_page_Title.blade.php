@if ($title == 'Contact')
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('/img/contact.jpg');">
    @else
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('/img/slider/slider_22.jpg');">
@endif
<div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

    <h2 class="text-uppercase">{{ $title }}</h2>
    <ol>
        <li><a href="{{ route('home') }}">Accueil</a></li>
        {!! isset($title_secondary) ? '<li>' . $title_secondary . '</li>' : '' !!}
        <li class="current">{{ $title }}</li>
    </ol>
</div>
</div>
