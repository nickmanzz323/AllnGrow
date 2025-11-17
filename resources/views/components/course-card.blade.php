<article class="course-card">
    <img src="{{ asset('images/dataPic.png') }}" 
         alt="{{ $course->title }}" 
         class="course-image" />

    <div class="course-rating">
        <img src="{{ asset('images/starSymbol.png') }}" 
             alt="5 star rating" 
             width="78" 
             height="14" />
        <span>4.5k</span>
    </div>

    <h3 class="course-title">{{ $course->title }}</h3>

    <div class="course-meta">
        <span>
            <img src="{{ asset('images/timeSymbol.png') }}" alt="Duration" width="32" height="14" />
            {{ $course->duration ?? '19h 30m' }}
        </span>

        <span>
            <img src="{{ asset('images/user.png') }}" alt="Students" width="30" height="14" />
            {{ $course->category->name ?? 'Unknown Category' }}
        </span>
    </div>
</article>
