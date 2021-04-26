@extends('layouts.app')
@section('content')
<div class="welcome-hero">
    <div class="hero-text-container">
        <h1>Welcome to Aston Animal Sanctuary</h1>
    </div>
</div>
<div class="container">
    <div class="cards justify-content-center-row">
        <div class="card info-card">
            <div class="icon"><i class="fas fa-stethoscope"></i></div>
            <div class="text"><p>All of our animals here at Aston Animal Sanctuary have their health thoroughly checked to make sure they live a healthy and happy life.</p></div>
        </div>
        <div class="card info-card">
            <div class="icon colour-red"><i class="fas fa-heart"></i></div>
            <div class="text"><p>Every animal is different, that is why we spend countless hours with each animal to make sure we understand their needs so we can find them the perfect new home.</p></div>
        </div>
        <div class="card info-card">
            <div class="icon colour-green"><i class="fas fa-home"></i></div>
            <div class="text"><p>All animals are house trained to ensure an easy transition from their life with us to their new life at their forever home.</p></div>
        </div>
    </div>
</div>

@endsection