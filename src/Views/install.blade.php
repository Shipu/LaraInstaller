<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="token" value="{{ csrf_token() }}">
    <title>Lara Web Installer</title>
    <link rel="stylesheet" href="{{ asset('shipu/installer/css/shipu.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
</head>
<body>
        <div id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li :class="className.welcome">Welcome</li>
                <li :class="className.extension">Requirements</li>
                <li :class="className.permission">Permissions</li>
                <li :class="className.database">Database</li>
                <li :class="className.finish">Finished</li>
            </ul>
            <component :is="msg"></component>
        </div>
    @include('Installer::components.Welcome')
    @include('Installer::components.Extension')
    @include('Installer::components.Database')
    @include('Installer::components.Permission')
    @include('Installer::components.Finish')

    {{--{!! Form::close() !!}--}}
    {{--<script src="https://cdn.jsdelivr.net/requirejs/2.1.22/require.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/vue/1.0.26/vue.js"></script>
    {{--<script src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/vue.validator/2.1.4/vue-validator.min.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/vue.router/0.7.10/vue-router.min.js"></script>--}}
    {{--<script src="https://raw.githubusercontent.com/laracasts/laravel-workflow-for-swapping-vue-components/master/public/js/main.js"></script>--}}
    <script>
    //    import Vue from 'vue';
    //    import Welcome from "./components/Welcom.vue";
    //    var Vue = Vue.use require('vue');
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
                    this.$parent.setmsg(msg);
                }
            }
        });

        Vue.component('database', {
            template: '#database',
            methods: {
                nextorprevious: function (msg) {
                    this.$parent.setmsg(msg);
                }
            }
        });

        Vue.component('permission', {
            template: '#permission',
            methods: {
                nextorprevious: function (msg) {
                    this.$parent.setmsg(msg);
                }
            }
        });

        Vue.component('finish', {
            template: '#finish',
            methods: {
                nextorprevious: function (msg) {
                    if(msg == 'finish') {
                        window.location.href = "{{ url('/finishinstallation') }}";
                    } else {
                        this.$parent.setmsg(msg);
                    }
                }
            }
        });

        var vm = new Vue({
            el: 'body',
            data: {
                msg         : '',
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
                    var status = ['welcome', 'extension', 'permission', 'database', 'finish'];
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
            },
            ready: function () {
                msg = "{{ isset($nextView) ? $nextView : 'welcome' }}";
                this.setmsg(msg);
            }
        })
    </script>
</body>
</html>