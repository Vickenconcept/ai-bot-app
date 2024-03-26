<div>
    <form action="">
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Select an
            option</label>

        <select id="countries" wire:model="lang" wire:change="selectLanguage"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
            <option @if ($conversation->lang == null) selected @endif>Choose a country</option>
            <option @if ($conversation->lang == 'EN') selected @endif value="EN">English</option>
            <option @if ($conversation->lang == 'DE') selected @endif value="DE">Germany (German)</option>
            <option @if ($conversation->lang == 'ES') selected @endif value="ES">Spain (Spanish)</option>
            <option @if ($conversation->lang == 'FR') selected @endif value="FR">France (French)</option>
            <option @if ($conversation->lang == 'IT') selected @endif value="IT">Italy (Italian)</option>
            <option @if ($conversation->lang == 'PT') selected @endif value="PT">Portugal (Portuguese)</option>
            <option @if ($conversation->lang == 'RU') selected @endif value="RU">Russia (Russian)</option>
            <option @if ($conversation->lang == 'ZH') selected @endif value="ZH">China (Chinese)</option>
            <option @if ($conversation->lang == 'JA') selected @endif value="JA">Japan (Japanese)</option>
            <option @if ($conversation->lang == 'AR') selected @endif value="AR">Saudi Arabia (Arabic)</option>
            <option @if ($conversation->lang == 'HI') selected @endif value="HI">India (Hindi)</option>
            <option @if ($conversation->lang == 'BN') selected @endif value="BN">Bangladesh (Bengali)</option>
            <option @if ($conversation->lang == 'UR') selected @endif value="UR">Pakistan (Urdu)</option>
            <option @if ($conversation->lang == 'KO') selected @endif value="KO">South Korea (Korean)</option>
            <option @if ($conversation->lang == 'TR') selected @endif value="TR">Turkey (Turkish)</option>
            <option @if ($conversation->lang == 'NL') selected @endif value="NL">Netherlands (Dutch)</option>
            <option @if ($conversation->lang == 'SV') selected @endif value="SV">Sweden (Swedish)</option>
            <option @if ($conversation->lang == 'NO') selected @endif value="NO">Norway (Norwegian)</option>
            <option @if ($conversation->lang == 'DA') selected @endif value="DA">Denmark (Danish)</option>
            <option @if ($conversation->lang == 'FI') selected @endif value="FI">Finland (Finnish)</option>

        </select>
    </form>
</div>
