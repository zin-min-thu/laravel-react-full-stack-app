import { Feature } from "@/types";
import { Link } from "@inertiajs/react";
import { useState } from "react";
import FeatureActiosDropdown from "./FeatureActiosDropdown";
import FeatureUpvoteDownvote from "./FeatureUpvoteDownvote";

export default function FeatureItem({feature}: {feature: Feature}) {
    const [isExpanded, setIsExpanded] = useState(false);
    const toggleReadmore = () => setIsExpanded(!isExpanded);

    return (
        <div className="mb-4 overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
            <div className="p-6 text-gray-900 dark:text-gray-100 flex gap-8">
                <FeatureUpvoteDownvote feature={feature} />
                <div className="flex-1">
                    <h2 className="text-2xl mb-2">
                        <Link prefetch href={route('feature.show', feature.id)}>{feature.name}</Link>
                    </h2>
                    <p>
                        {isExpanded ? feature.description : `${feature.description.substring(0, 200)}...`}
                    </p>
                    <button className="text-blue-500 hover:underline" onClick={toggleReadmore}>
                        {isExpanded ? 'Read less' : 'Read more'}
                    </button>
                    <div className="mt-4">
                        <Link href={route('feature.show', feature.id)}
                            className="inline-flex items-center justify-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span className="w-full">Comments</span>
                            <svg className="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </Link> 
                    </div>
                </div>
                <div>
                    <FeatureActiosDropdown feature={feature} />
                </div>
            </div>
            
        </div>
    );
}