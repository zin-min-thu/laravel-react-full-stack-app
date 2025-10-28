import FeatureItem from '@/Components/FeatureItem';
import FeatureUpvoteDownvote from '@/Components/FeatureUpvoteDownvote';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Feature } from '@/types';
import { Head } from '@inertiajs/react';

export default function Index({feature}: {feature: Feature}) {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Feature <b>{feature.name}</b>
                </h2>
            }
        >
            <Head title={`Feature ${feature.name}`} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                            <FeatureUpvoteDownvote feature={feature} />
                            <div className="flex-1">
                                <h2 className="text-2xl mb-2">{feature.name}</h2>
                                <p>
                                    {feature.description}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
