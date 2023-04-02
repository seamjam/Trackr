<x-app-layout>
    <x-session-alert/>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">

        <x-search-bar :route="route('webshop.reviews.show')" :placeholder="'search review'"/>


        @if ($packages->whereNotNull('review.stars')->count() > 0)

            <x-review-overview :objects="$packages"/>

        @else
            <p class="text-center mb-5 mt-5"><i>There are no reviews left</i></p>
        @endif

        <x-pagination-link :objects="$packages"/>


    </div>
</x-app-layout>
