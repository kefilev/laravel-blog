import React from 'react';
import { PostProps } from '@/types/blog';

const Show = ({ post }: PostProps) => {
    console.log(post);
    return (
        <div className="max-w-3xl mx-auto px-4 py-10">
            <h1 className="text-3xl font-bold mb-8">{post.title}</h1>
            <p className="text-gray-600 mb-4">{post.content}</p>

            <h2 className="text-xl font-semibold mt-6 mb-4">Comments ({post.comments.length})</h2>

            <div className="space-y-4">
                {post.comments.map((comment) => (
                    <div key={comment.id} className="mb-4">
                        <p className="text-sm font-semibold">
                            {comment.user?.name ?? 'Anonymous'} said:
                        </p>
                        <p className="text-gray-700">{comment.body}</p>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Show;
