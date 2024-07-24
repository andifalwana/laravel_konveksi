<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-4">
                        <form action="{{ route('sales.index') }}" method="GET" class="flex">
                            <input type="text" name="search" placeholder="Search sales..." class="border rounded-l px-4 py-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Search</button>
                        </form>
                        <div>
                            <a href="{{ route('sales.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mr-2">Add New Sale</a>
                            <a href="{{ route('sales.report') }}" class="bg-purple-500 text-white px-4 py-2 rounded">Generate Report</a>
                        </div>
                    </div>
                    
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $sale->product_name }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $sale->quantity }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $sale->price }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $sale->total }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ $sale->sale_date }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                    <a href="{{ route('sales.edit', $sale) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>