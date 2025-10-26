import FeatureItem from '@/Components/FeatureItem';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import { FormEventHandler } from 'react';
import TextAreaInput from '@/Components/TextAreaInput';
import PrimaryButton from '@/Components/PrimaryButton';
import { Feature } from '@/types';

export default function Edit({feature} : {feature: Feature}) {
    const{
        data,
        setData,
        put,
        errors,
        reset,
        processing,
    } = useForm({
        name: feature.name,
        description: feature.description,
    });

    const updateFeature: FormEventHandler = (e) => {
        e.preventDefault();
        put(route('feature.update', feature.id), {
            preserveScroll: true,
        });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Edit Feature <b>{feature.name}</b>
                </h2>
            }
        >
            <Head title={`Edit Feature ${feature.name}`} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                            <form onSubmit={updateFeature} className="w-full">
                                <div className="mb-7">
                                    <InputLabel htmlFor="name" value="Name" />
                
                                    <TextInput
                                        id="name"
                                        className="mt-1 block w-full"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        isFocused
                                        autoComplete="name"
                                    />
                
                                    <InputError className="mt-2" message={errors.name} />
                                </div>
                                <div className="mb-7">
                                    <InputLabel htmlFor="description" value="Description" />
                
                                    <TextAreaInput
                                        rows={6}
                                        id="description"
                                        className="mt-1 block w-full"
                                        value={data.description}
                                        onChange={(e) => setData('description', e.target.value)}
                                    />
                
                                    <InputError className="mt-2" message={errors.description} />
                                </div>
                                <div className="flex items-center gap-4">
                                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
