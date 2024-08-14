<div

    x-data="{body: ''}"

    x-show="body.length"

    x-cloak

    x-on:message.window="body = $event.detail.body; setTimeout(() => body = '', $event.detail.timeout || 2000)"

    class="fixed inset-0 flex px-4 py-6 items-start pointer-events-none"

    x-init="

        @if (session()->has('message'))

            window.onload = () => {

                window.dispatchEvent(new CustomEvent('message', {

                    detail: {

                        body: '{{ session('message') }}',

                        timeout: 3000

                    }

                }))

            }

        @endif
">

    <div class="w-full flex flex-col items-center space-y-4 mt-10 ">

        <div class="max-w-sm w-full bg-green-700 rounded-lg pointer-events-auto shadow-2xl">

            <div class="p-4 flex items-center">

                <div class="ml-2 w-0 flex-1 text-white">

                    <span x-text="body"></span>

                </div>

                <button class="inline-flex text-gray-400" x-on:click="body = ''">

                    <span class="sr-only">Close</span>

                    <span class="text-2xl">&times;</span>

                </button>

            </div>

        </div>

</div>

</div>