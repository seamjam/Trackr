@props(['objects', 'direction'])

<script src="{{ asset('/js/webshop.modal.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/app.css') }}">


<div class="ml-10 ">
    <table class="w-full ml-2">
        <thead>
        <tr>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.webshop.show', ['sort' => 'webshop_name', 'direction' => $direction]) }}">{{__('titles.websop_name')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.webshop.show', ['sort' => 'owner_name', 'direction' => $direction]) }}">{{__('titles.admin_name')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.webshop.show', ['sort' => 'email', 'direction' => $direction]) }}">{{__('titles.email')}}</a>
            </th>
            <th class="w-1/6 text-left">
                <a href="{{ route('superadmin.webshop.show', ['sort' => 'phone_number', 'direction' => $direction]) }}">{{__('titles.phonenumber')}}</a>
            </th>

            <th class="w-1/6 text-left"></th>
        </tr>
        </thead>
        <tbody class="h-40 overflow-y-scroll">
        @foreach ($objects as $object)
            <tr class="clickable" data-webshop-name="{{ $object->webshop->name }}"
                data-webshop-address="{{ $object->webshop->postcode }}, {{ $object->webshop->house_number }}">
                <td class="py-1 border-b">{{ $object->webshop->name }}</td>
                <td class="py-1 border-b">{{ $object->name }}</td>
                <td class="py-1 border-b">{{ $object->email }}</td>
                <td class="py-1 border-b">{{ $object->phonenumber }}</td>
                <td class="py-1 border-b">
                    <form action="{{ route('superadmin.webshop.edit', $object->id) }}" method="GET">
                        <button type="submit" class="border-gray-400 bg-black text-white font-bold py-2 px-4 rounded">
                            {{__('titles.edit')}}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fixed w-full h-full top-10 left-0 flex items-center justify-center hidden" id="user-modal">
    <div class="modal-overlay absolute w-full h-full "></div>
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto modal">
        <div class="modal-content py-4 text-left px-6">
            <div class="modal-header flex justify-between items-center pb-3">
                <h5 class="text-2xl font-bold" id="user-modal-label">{{__('titles.webshop_information')}}</h5>
                <button type="button" class="close-modal cursor-pointer z-50" data-bs-dismiss="modal"
                        aria-label="Close">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         viewBox="0 0 18 18">
                        <path
                            d="M18 1.11L16.89 0 9 7.89 1.11 0 0 1.11 7.89 9 0 16.89 1.11 18 9 10.11 16.89 18 18 16.89 10.11 9z"></path>
                    </svg>
                </button>
            </div>

            <div class="modal-body">
                <p>{{__('titles.webshop_name')}}: <span id="user-webshop-name"></span></p>
                <p>{{__('titles.admin_name')}}: <span id="user-name"></span></p>
                <p>{{__('titles.email')}}: <span id="user-email"></span></p>
                <p>{{__('titles.phonenumber')}}: <span id="user-phone"></span></p>
            </div>
        </div>
    </div>
</div>



