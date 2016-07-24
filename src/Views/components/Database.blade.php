<template id="database">
    <fieldset>
        <h2 class="fs-title">Database</h2>
        <h3 class="fs-subtitle">Please prepare an empty database for this installation.</h3>
        <select name="driver" id="driver" required>
            <option value="">Select Database Type</option>
            <option value="mysql" @if (old('driver') == 'mysql') selected="selected" @endif>
                MySQL
            </option>
            <option value="pgsql" @if (old('driver') == 'pgsql') selected="selected" @endif>
                Postgres
            </option>
            <option value="sqlite" @if (old('driver') == 'sqlite') selected="selected" @endif>
                SQLite
            </option>
        </select>
        <input  type="text" name="host" placeholder="Mysql Host (Example: localhost)" value="{{ old('host') }}" required/>
        <input type="text" name="database" placeholder="Database Name" value="{{ old('database') }}" required/>
        <input type="text" name="username" placeholder="MySQL Username" value="{{ old('username') }}" required/>
        <input type="password" name="password" placeholder="MySQL Password" value="{{ old('password') }}" required/>
        <button @click="nextorprevious('permission')" class="previous action-button"> Previous </button>
        {{--<button @click.prevent="nextorprevious('permission')" class="next action-button"> Next </button>--}}
        <input type="submit"  class="next action-button" value="Next" />
    </fieldset>
</template>