<x-mail::message>
# Introduction

Welcome to AliExercise {{ $user->first_name }} {{ $user->last_name }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
