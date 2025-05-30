@extends('layouts.master')

@section('title', 'Order Ticket | Nonton Bareng')

@section('content')
    <div id="TopNav" class="sticky flex items-center justify-between px-5 top-0 z-50 py-[0.75rem]">
        <div class="flex gap-5 items-center">
            <a href="{{ route('home') }}"
                class="w-12 h-12 flex items-center justify-center shrink-0 rounded-full overflow-hidden bg-white/10 backdrop-blur-sm">
                <x-heroicon-s-arrow-left-circle class="w-9 h-9 text-[#ffffff25]" />
            </a>
            <div class="flex flex-col">
                <p class="font-semibold text-white truncate max-w-[12rem]">{{ $scheduleData['film'] }} Uji Coba 123</p>
                <p class="text-xs font-extralight text-[#d1d5dc]">{{ $scheduleData['studio'] }}</p>
            </div>
        </div>
        <div
            class="h-12 flex flex-col items-center justify-center shrink-0 rounded-lg overflow-hidden bg-white/10 backdrop-blur-sm p-3">
            <p class="text-xs font-extralight text-[#d1d5dc]">
                {{ \Carbon\Carbon::parse($scheduleData['play_date'])->isoFormat('DD MMM') }}</p>
            <p class="font-medium text-white">{{ \Carbon\Carbon::parse($scheduleData['play_time'])->format('H:i') }}</p>
        </div>
    </div>

    <form action="{{ route('ticket.create') }}" method="post" class="mt-5">
        @csrf
        <input type="hidden" name="schedule_id" value="{{ $scheduleData['id'] }}">

        <div class="flex w-full px-5 justify-center mb-9 gap-8">
            <div class="flex gap-2">
                <div class="w-5 h-5 rounded-[0.25rem] bg-[#1e2939] dark:bg-[#4a5565]"></div>
                <div class="text-sm">available</div>
            </div>
            <div class="flex gap-2">
                <div class="w-5 h-5 rounded-[0.25rem] bg-[#ff6467] dark:bg-[#fb2c36]"></div>
                <div class="text-sm">booked</div>
            </div>
            <div class="flex gap-2">
                <div class="w-5 h-5 rounded-[0.25rem] bg-[#008236]"></div>
                <div class="text-sm">selected</div>
            </div>
        </div>

        <div
            class="items-center justify-center w-[20rem] mx-auto h-[30px] bg-[#364153] dark:bg-[#6a7282] flex flex-col text-center text-white rounded-xl mb-[6rem]">
            Layar
        </div>

        @foreach ($seats as $rowSeats)
            <div class="grid grid-cols-6 items-center justify-center w-max mx-auto gap-3 mb-5">
                @foreach ($rowSeats as $seat)
                    <label class="cursor-pointer">
                        <input type="radio" name="seat_id" value="{{ $seat->id }}" class="sr-only peer seat-radio"
                            @if ($seat->is_booked) disabled @endif>
                        <div
                            class="rounded-xl w-12 h-12 text-white flex flex-col text-center justify-center {{ $seat->is_booked ? 'bg-[#ff6467] dark:bg-[#fb2c36] cursor-not-allowed' : 'bg-[#1e2939] dark:bg-[#4a5565] peer-checked:bg-[#008236]' }}">
                            {{ $seat->seat_number }}
                        </div>
                    </label>
                @endforeach
            </div>
        @endforeach

        <div id="BottomButton" class="sticky flex w-full h-[98px] shrink-0 z-50">
            <div class="fixed bottom-[30px] w-full max-w-[640px] px-5 z-10">
                <button type="submit"
                    class="w-full rounded-full p-[14px_20px] bg-[#024a70] font-bold text-white text-center">Booking
                    Now</button>
            </div>
        </div>
    </form>
@endsection
