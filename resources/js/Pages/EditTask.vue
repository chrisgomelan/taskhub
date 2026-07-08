<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({
    task: Object,
})

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    is_completed: props.task.is_completed,
})

const submit = () => {
    form.put(route('tasks.update', props.task.id));
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text" v-model="form.title" />
                            <InputLabel for="description" value="Description" />
                            <TextInput id="description" type="text" v-model="form.description" />
                            <InputLabel for="due_date" value="Due Date" />
                            <TextInput id="due_date" type="date" v-model="form.due_date" />
                            <InputLabel for="is_completed" value="Is Completed" />
                            <TextInput id="is_completed" type="checkbox" v-model="form.is_completed" />
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>