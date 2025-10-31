import { Feature } from "@/types";
import CommentItem from "./CommentItem";
import TextAreaInput from "./TextAreaInput";
import { FormEventHandler } from "react";
import { useForm, usePage } from "@inertiajs/react";
import InputError from "./InputError";
import { can } from "@/helpers";

export default function NewCommentForm({feature}: {feature: Feature}) {

    const user = usePage().props.auth.user

    const {data, setData, post, errors} = useForm( {
        comment: '',
    } );

    const createComment: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('comment.store', feature.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                setData('comment', '');
            }
        });
    }

    if(!can(user, 'manage_comments')) {
        return (
            <div className="text-center text-gray-400 mt-7">
                <p>You don't have permission to comment.</p>
            </div>
        )
    }

    return(
        <div>
            <form onSubmit={createComment} className="flex gap-2 w-full py-7">
                <div className="flex-1 ">
                    <TextAreaInput
                        name="comment"
                        value={data.comment}
                        onChange={(e) => setData('comment', e.target.value)}
                        rows={1}
                        placeholder="Add a comment..."
                        className="w-full flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </TextAreaInput>
                    <InputError className="mt-2" message={errors.comment} />
                </div>
                <div>
                    <button
                        className="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                    >
                        Comment
                    </button>
                </div>
            </form>
        </div>
    )
}