import { Feature } from "@/types";
import { useForm } from "@inertiajs/react";

export default function FeatureUpvoteDownvote({feature}: {feature: Feature}) {

    const upvoteForm = useForm({
        upvote: true
    });

    const downvoteForm = useForm({
        upvote: false
    });

    const upvoteDownvote = (upvote : boolean) => {
        if(feature.has_upvoted && upvote || feature.has_downvoted && !upvote) {
            upvoteForm.delete(route('feature.upvote.destroy', feature.id), {
                preserveScroll: true
            });
        } else {
            if(upvote) {
                upvoteForm.post(route('feature.upvote.store', feature.id), {
                    preserveScroll: true
                });
            } else {
                downvoteForm.post(route('feature.upvote.store', feature.id), {
                    preserveScroll: true
                });
            }
        }
    }

    return(
         <div className="flex flex-col items-center">
            <button onClick={() => upvoteDownvote(true)} className={feature.has_upvoted ? 'text-red-600' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" className="size-8">
                <path strokeLinecap="round" strokeLinejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>
            </button>
            <span className={'font-bold' + 
                (feature.has_upvoted || feature.has_downvoted ? ' text-red-600' : '')
            }>
                {feature.upvote_count}
            </span>
            <button onClick={() => upvoteDownvote(false)} className={feature.has_downvoted ? 'text-red-600' : ''}>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" className="size-8">
                <path strokeLinecap="round" strokeLinejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>
    )
}