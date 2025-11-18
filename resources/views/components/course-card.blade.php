<article class="course-card">
    <!-- Thumbnail -->
    @if($course->thumbnail)
        <img src="{{ asset('storage/' . $course->thumbnail) }}"
             alt="{{ $course->title }}"
             class="course-image" />
    @else
        <div class="course-image-placeholder">
            <i class="fas fa-book"></i>
        </div>
    @endif

    <!-- Category & Price Badge -->
    <div class="course-badges">
        @if($course->category)
            <span class="badge-category">{{ $course->category->name }}</span>
        @endif
        @if($course->price == 0)
            <span class="badge-free">Free</span>
        @else
            <span class="badge-price">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
        @endif
    </div>

    <!-- Title -->
    <h3 class="course-title">
        {{ Str::limit($course->title, 50, '...') }}
    </h3>

    <!-- Description -->
    @if($course->description)
        <p class="course-description">
            {{ Str::limit($course->description, 80, '...') }}
        </p>
    @endif

    <!-- Instructor -->
    @if($course->instructor)
        <div class="course-instructor">
            <i class="fas fa-user-circle"></i>
            <span>{{ $course->instructor->name ?? $course->instructor->email }}</span>
        </div>
    @endif

    <!-- Meta -->
    <div class="course-meta">
        <span>
            <i class="fas fa-book-open"></i>
            {{ $course->subcourses_count ?? $course->subcourses()->count() }} Lessons
        </span>

        <span>
            <i class="fas fa-users"></i>
            {{ $course->students_count ?? $course->students()->count() }} Students
        </span>
    </div>

    <!-- Action Button -->
    <a href="{{ route('course.show', $course->courseID) }}" class="course-action-btn">
        <span>View Course</span>
        <i class="fas fa-arrow-right"></i>
    </a>
</article>
