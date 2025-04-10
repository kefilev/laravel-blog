import React from 'react';
import { useForm, usePage } from '@inertiajs/react';
import { PostProps } from '@/types/blog';

const Show = ({ post }: PostProps) => {
    const { props } = usePage();
    const auth = props.auth as { user: { name: string } | null };

    const { data, setData, post: submit, processing, reset, errors } = useForm({
        body: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        submit(`/blog/${post.slug}/comments`, {
            onSuccess: () => reset(),
        });
    };

    return (
        <div className="max-w-3xl mx-auto px-4 py-10">
            <h1 className="text-3xl font-bold mb-8">{post.title}</h1>
            <p className="text-gray-600 mb-4">{post.content}</p>

            <h2 className="text-xl font-semibold mt-6 mb-4">
                Comments ({post.comments.length})
            </h2>

            <div className="space-y-4 mb-10">
                {post.comments.map((comment) => (
                    <div key={comment.id} className="mb-4">
                        <p className="text-sm font-semibold">
                            {comment.user?.name ?? 'Anonymous'} said:
                        </p>
                        <p className="text-gray-700">{comment.body}</p>
                    </div>
                ))}
            </div>

            {/* Add comment form */}
            {auth.user ? (
                <form onSubmit={handleSubmit} className="bg-white p-6 rounded-xl shadow">
                    <textarea
                        className="bg-black w-full p-3 border rounded-xl focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Write a comment..."
                        value={data.body}
                        onChange={(e) => setData('body', e.target.value)}
                    />
                    {errors.body && (
                        <p className="text-red-600 text-sm mt-1">{errors.body}</p>
                    )}
                    <button
                        type="submit"
                        disabled={processing}
                        className="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                    >
                        {processing ? 'Posting...' : 'Post Comment'}
                    </button>
                </form>
            ) : (
                <p className="text-gray-600">You must be logged in to comment.</p>
            )}

        </div>
    );
};

export default Show;
