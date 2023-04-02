<div class="my-5">
    <h2 class="text-xl font-medium text-gray-900 mb-3">{{__('titles.set_review')}}</h2>
    <form action="{{ route('customer.review') }}" method="post">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">

        <div class="mb-3">
            <label for="rating" class="block text-gray-700 text-sm font-medium mb-2">{{__('titles.amount_stars')}}:</label>
            <select name="rating" id="rating" class="form-select block w-full mt-1 text-sm rounded-md">
                <option value="">{{__('titles.amount_stars')}}</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="block text-gray-700 text-sm font-medium mb-2">{{__('titles.review')}}:</label>
            <textarea name="review" id="review" rows="4"
                      class="form-textarea block w-full mt-1 text-sm rounded-md"></textarea>
        </div>
        <button type="submit" class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2 mt-4">{{__('titles.send_review')}}
        </button>
    </form>
</div>
