<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lara Web Installer</title>
    <link rel="stylesheet" href="./css/shipu.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
</head>
<body>
    <validator name="validation1">
        <!-- multistep form -->
        <form id="msform" method="post" action="{{ url('install') }}" novalidate>
            <!-- progressbar -->
            <ul id="progressbar">
                <li :class="className.welcome">Welcome</li>
                <li :class="className.extension">Requirements</li>
                <li :class="className.database">Database</li>
                <li :class="className.permission">Permissions</li>
                <li :class="className.finish">Finished</li>
            </ul>
            <component :is="msg"></component>
        </form>
    </validator>
    <!-- fieldsets -->
    <template id="welcome">
        <fieldset>
            <div class="welcome">
                Hello, Welcome to Laravel 5 Web Installer
            </div>
            <button @click="nextorprevious('extension')" class="next action-button"> Next </button>
        </fieldset>
    </template>
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
            <button @click="nextorprevious('database')" class="next action-button"> Next </button>
        </fieldset>
    </template>
    <template id="database">
        <fieldset>
            <h2 class="fs-title">Database</h2>
            <h3 class="fs-subtitle">Please prepare an empty database for this installation.</h3>
            <select name="driver" id="driver">
                <option value="">Select Database Type</option>
                <option value="mysql">MySQL</option>
                <option value="pgsql">Postgres</option>
                <option value="sqlite">SQLite</option>
            </select>
            <input  type="text" v-validate:host="{ required: true }" name="host" placeholder="Mysql Host (Example: localhost)" />
            <p v-if="$validation1.host.required">required host</p>
            <input type="text" name="database" placeholder="Database Name" />
            <input type="text" name="username" placeholder="MySQL Username" />
            <input type="password" name="password" placeholder="MySQL Password"/>
            <button @click="nextorprevious('extension')" class="previous action-button"> Previous </button>
            <button @click="nextorprevious('permission')" class="next action-button"> Next </button>
        </fieldset>
    </template>
    <template id="permission">
        <fieldset>
            <h2 class="fs-title">Permissions</h2>
            <h3 class="fs-subtitle">Check for folder permissions</h3>
            <ul class="permission">
                <li class="{{ $permission[0] ? 'pass' : 'fail' }}">Storage/app/ <span class="pvalue">775</span></li>
                <li class="{{ $permission[1] ? 'pass' : 'fail' }}">Storage/framework/ <span class="pvalue">775</span></li>
                <li class="{{ $permission[2] ? 'pass' : 'fail' }}">Storage/logs/ <span class="pvalue">775</span></li>
                <li class="{{ $permission[3] ? 'pass' : 'fail' }}">Bootstrap/cache/ <span class="pvalue">775</span></li>
            </ul>
            <button @click="nextorprevious('database')" class="previous action-button"> Previous </button>
            <button @click="nextorprevious('welcome')" class="next action-button"> Next </button>
            {{--<input type="button" class="previous action-button" value="Previous" />--}}
            {{--<input type="submit" class="next action-button" value="Next" />--}}
        </fieldset>
    </template>
    <template id="finish">
        <fieldset>
            <div class="finished">
                Congratulation, Completed Installation Process !!!
            </div>
            <button @click="nextorprevious('permission')" class="previous action-button"> Previous </button>
            <button @click="nextorprevious('finish')" class="next action-button"> Next </button>
        </fieldset>
    </template>
{{--{!! Form::close() !!}--}}
<script src="https://cdn.jsdelivr.net/vue/1.0.24/vue.js"></script>
<script src="https://cdn.jsdelivr.net/vue.validator/2.1.4/vue-validator.min.js"></script>
<script>
    Vue.component('welcome', {
        template: '#welcome',
        methods: {
            nextorprevious: function (msg) {
                this.$parent.setmsg(msg);
            }
        }
    });

    Vue.component('extension', {
        template: '#extension',
        methods: {
            nextorprevious: function (msg) {
                this.$parent.setmsg(msg)
                this.$parent.extension = 'active';
            }
        }
    });

    Vue.component('database', {
        template: '#database',
        methods: {
            nextorprevious: function (msg) {
                this.$parent.setmsg(msg)
            }
        }
    });

    Vue.component('permission', {
        template: '#permission',
        methods: {
            nextorprevious: function (msg) {
                this.$parent.setmsg(msg)
            }
        }
    });

    Vue.component('finish', {
        template: '#finish',
        methods: {
            nextorprevious: function (msg) {
                this.$parent.setmsg(msg)
            }
        }
    });

    var vm = new Vue({
        el              : 'body',
        data: {
            msg         : 'welcome',
            className   : {
                welcome     : 'active',
                extension   : '',
                permission  : '',
                database    : '',
                finish      : '',
            }
        },
        methods: {
            setmsg      : function (msg) {
                this.msg = msg;
                var status = ['welcome', 'extension', 'database', 'permission', 'finish'];
                var f = 1;
                var className = this.className;
                status.forEach(function (value) {
                    if(f) {
                        className[value] = 'active';
                    } else {
                        className[value] = '';
                    }

                    if(value==msg) {
                        f = 0;
                    }
                });
            }
        }
    })
</script>
</body>
</html>