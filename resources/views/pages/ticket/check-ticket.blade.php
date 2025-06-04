@extends('layouts.master')

@section('title', 'Cek Ticket | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('home') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-[#99a1af50] dark:bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#6a728230] dark:text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-[#1e2939] dark:text-[#ffffff] max-w-[12rem]">Cek Tiket</p>
            </div>
        </div>
    </div>

    <div class="px-6 mt-5 flex flex-col items-center justify-center">
        <p class="font-bold text-xl">Scan QR Code</p>
        <p class="text-sm mb-5">Scan tiket nonton siswa untuk memvalidasi</p>
        <div id="reader" class="w-[500px]"></div>
        <div id="response" class="w-full items-center justify-center mt-4 rounded-lg px-3 py-2 hidden">

        </div>
    </div>

    <x-footer />
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/qrscripts.min.js') }}"></script>
    <script>
        const html5Qrcode = new Html5Qrcode('reader');
        const responseDiv = document.getElementById('response');
        let isScanning = true;

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            if (decodedText && isScanning) {
                isScanning = false;

                fetch("{{ route('ticket.validate') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            code: decodedText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        responseDiv.innerHTML = `<p class="text-center">${data.message}</p>`;
                        responseDiv.classList.remove('hidden');
                        responseDiv.classList.add('flex');
                        if (data.status == 'error') {
                            responseDiv.classList.add('bg-[#ec003f]');
                        } else {
                            responseDiv.classList.add('bg-[#00a63e]');
                        }

                        setTimeout(() => {
                            isScanning = true;
                            responseDiv.classList.add('hidden');
                            responseDiv.classList.remove('flex');
                            if (data.status == 'error') {
                                responseDiv.classList.remove('bg-[#ec003f]');
                            } else {
                                responseDiv.classList.remove('bg-[#00a63e]');
                            }
                        }, 3000);
                    })
                    .catch(error => {
                        responseDiv.innerHTML =
                            `<p class="text-[#fb2c36] text-center">Terjadi kesalahan atau QR tidak valid. Silahkan coba lagi.</p>`;
                        responseDiv.classList.remove('hidden');
                        responseDiv.classList.add('flex');

                        setTimeout(() => {
                            isScanning = true;
                            responseDiv.classList.add('hidden');
                            responseDiv.classList.remove('flex');
                        }, 3000);
                    });
            }
        }
        const config = {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        }
        html5Qrcode.start({
            facingMode: "environment"
        }, config, qrCodeSuccessCallback);
    </script>
@endpush
