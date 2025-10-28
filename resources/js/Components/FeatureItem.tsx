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
                    <h2 className="text-2xl mb-2 hover:underline">
                        <Link href={route('feature.show', feature.id)}>{feature.name}</Link>
                    </h2>
                    <p>
                        {isExpanded ? feature.description : `${feature.description.substring(0, 200)}...`}
                    </p>
                    <button className="text-blue-500 hover:underline" onClick={toggleReadmore}>
                        {isExpanded ? 'Read less' : 'Read more'}
                    </button>
                </div>
                <div>
                    <FeatureActiosDropdown feature={feature} />
                </div>
            </div>
        </div>
    );
}