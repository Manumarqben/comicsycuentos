<div>
    @foreach ($applicants as $applicant)
        <p>
            {{ $applicant->alias }}
        </p>
    @endforeach
</div>
