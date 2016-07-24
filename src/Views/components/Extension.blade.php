<template id="extension">
    <fieldset>
        <h2 class="fs-title">Requirements</h2>
        <h3 class="fs-subtitle">Check PHP Extension</h3>
        <ul class="extension">
            <li class="{{ isset($extension['phpVersion']) ? 'pass' : 'fail' }}">PHP version 5.5.9 or greater required</li>
            <li class="{{ isset($extension['curl']) ? 'pass' : 'fail' }}">cURL PHP Extension is required</li>
            <li class="{{ isset($extension['pdoLibrary']) ? 'pass' : 'fail' }}">PDO PHP Extension is required</li>
            <li class="{{ isset($extension['mbstring']) ? 'pass' : 'fail' }}">Mbstring PHP Extension is required</li>
            <li class="{{ isset($extension['openssl']) ? 'pass' : 'fail' }}">OpenSSL PHP Extension is required</li>
            <li class="{{ isset($extension['zip']) ? 'pass' : 'fail' }}">ZipArchive PHP Library is required</li>
        </ul>
        <button @click="nextorprevious('welcome')" class="previous action-button"> Previous </button>
        <button @click="nextorprevious('permission')" class="next action-button"> Next </button>
    </fieldset>
</template>