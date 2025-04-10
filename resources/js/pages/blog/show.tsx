import { Post, PostResponse } from '@/types/blog';
import React from 'react';

export default function Show({ post }: PostResponse) {

    console.log(post);

    return (
        <div className="max-w-3xl mx-auto py-10 px-4">
            <h1 className="text-3xl font-bold mb-4">{post.title}</h1>
            <p className="text-gray-600 text-sm mb-2">
                Published on {new Date(post.created_at).toLocaleDateString()}
            </p>
            <div className="prose max-w-none" dangerouslySetInnerHTML={{ __html: post.content }} />
        </div>
    );
}
