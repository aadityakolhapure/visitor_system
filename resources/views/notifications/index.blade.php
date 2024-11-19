<x-app-layout>

        <div class="py-12 sm:ml-64 mt-14">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Notifications</h2>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Mark All as Read
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="space-y-4">
                        @forelse($notifications as $notification)
                            <div class="p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-blue-50' }} rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold">{{ $notification->data['message'] }}</p>
                                        <p class="text-sm text-gray-600">Purpose: {{ $notification->data['purpose'] }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($notification->data['check_in'])->diffForHumans() }}
                                        </p>
                                    </div>
                                    @if(!$notification->read_at)
                                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-sm text-blue-500 hover:text-blue-700">
                                                Mark as Read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No notifications found.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
