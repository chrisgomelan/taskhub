<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TaskTable from '@/Components/TaskTable.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    tasks: Array,
})

const form = useForm({
    title: '',
    description: '',
    due_date: '',
})

const submitForm = () => {
    form.post(route('tasks.store'), {
        onFinish: () => form.reset(),
    })
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
      
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
                <form @submit.prevent="submitForm" class="mb-4 bg-white p-4 rounded-lg shadow-sm flex flex-col gap-4 ">
                    <h3 class="text-xl font-semibold mb-4">Create New Task</h3>
                    <div class="flex gap-4 w-full">
                    <div class="w-full">
                        <InputLabel value="Title" />
                        <TextInput class="w-full" v-model="form.title" type="text" placeholder="Title" required />
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="w-full">
                        <InputLabel value="Description" />
                        <TextInput class="w-full" v-model="form.description" type="text" placeholder="Description" required />
                        <InputError :message="form.errors.description" />
                    </div>
                    <div class="w-full">
                        <InputLabel value="Due Date" />
                        <TextInput class="w-full" v-model="form.due_date" type="date" placeholder="Due Date" required />
                        <InputError :message="form.errors.due_date" />
                    </div>
                    <div class="pt-5 h-10 w-full">
                        <PrimaryButton class="w-full" :disabled="form.processing" :class="{'opacity-50 cursor-not-allowed': form.processing}" type="submit">
                            {{ form.processing ? 'Creating...' : 'Create Task' }}
                        </PrimaryButton>
                    </div>
                    </div>
                </form>
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <TaskTable :tasks="tasks" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
