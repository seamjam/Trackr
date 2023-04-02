<x-app-layout>
    <script src="{{ asset('/js/label.create.js') }}" defer></script>

    <div class="bg-white p-4 rounded-lg" style="max-width: 1100px; margin: 50px auto 0;">
        <h1 class="text-center text-gray-900 text-3xl font-bold mb-5"> {{__('titles.register_package')}})</h1>

        <form id="myForm" method="POST" action="{{ route('administrator.labels.store') }}">
            @csrf

            <div style="display:flex; flex-wrap:wrap">
                <x-input-form-label label="Amount" type="number" placeholder=" {{__('titles.amount')}}"
                                    id="label_count"/>
                <div class="mb-4" style="flex:1;">
                    <label for="Delivery Company"
                           class="block text-gray-700 font-bold mb-2"> {{__('titles.delivery_company')}}</label>
                    <select name="post_company_id" id="post_company"
                            class="border-gray-300 rounded-lg px-4 py-2 w-full">
                        @foreach($post_companies as $post_company)
                            <option value="{{ $post_company->name }}">{{ $post_company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-input-form-label label="Postal Code" type="text" placeholder=" {{__('titles.postal_code')}}"
                                    id="postal_code"/>
                <x-input-form-label label="House Number" type="number" placeholder=" {{__('titles.house_number')}}"
                                    id="house_number"/>
                <x-input-form-label label="First Name" type="text" placeholder=" {{__('titles.first_name')}}"
                                    id="receiver_first_name"/>
                <x-input-form-label label="Last Name" type="text" placeholder="{{__('titles.last_name')}}"
                                    id="receiver_last_name"/>
                <button type="button" onclick="addLabel()"
                        class="text-black  px-0.5 rounded pt-3 pl-3"> {{__('titles.add')}}</button>
            </div>

            <div style="border: 1px solid black; height: 250px; overflow-y: auto;">
                <table id="label_table" class="mt-4" style="width:100%;">
                    <tbody>
                    </tbody>
                </table>
            </div>

            <input type="hidden" name="labels" id="labels_input">
            <button type="submit"
                    class="bg-black text-white font-bold py-2 px-4 rounded-lg mr-2 mt-4"> {{__('titles.create')}} Label
            </button>
        </form>
    </div>
</x-app-layout>


