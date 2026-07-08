<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    tasks: Array,
})

const destroy = (id) => {
    if(confirm('Are you sure you want to delete this task?')) {
        router.delete(route('tasks.destroy', id));
    }
}
</script>

<template>
    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Due Date</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in tasks" :key="task.id" class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                <td class="px-6 py-4">{{ task.title }}</td>
                <td class="px-6 py-4">{{ task.description }}</td>
                <td class="px-6 py-4">{{ task.due_date }}</td>
                <td class="px-6 py-4">{{ task.is_completed ? 'Completed' : 'Not Completed' }}</td>
                <td class="px-6 py-4">
                    <Link :href="route('tasks.edit', task.id)" class="text-blue-500 hover:text-blue-700">Edit</Link>
                    <Link :href="route('tasks.destroy', task.id)" method="delete" class="text-red-500 hover:text-red-700">Delete</Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>