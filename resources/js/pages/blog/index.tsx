import React from 'react';
import { Link } from '@inertiajs/react';
import Pagination from '@/components/pagination';
import { BlogProps } from '@/types/blog';

const BlogIndex = ({ posts }: BlogProps) => {
  console.log(posts);

  return (
    <div className="max-w-3xl mx-auto px-4 py-10">
      <h1 className="text-3xl font-bold mb-8 text-center">Blog Posts</h1>

      <div className="space-y-10">
        {posts.data.map((post) => (
          <div
            key={post.id}
            className="bg-gray-200 rounded-2xl shadow p-6 border border-gray-200"
          >
            <Link href={`/blog/${post.slug}`} className="text-xl font-semibold text-blue-600 hover:underline">
              {post.title}
            </Link>
            <p className="mt-1 mb-4 text-sm text-gray-500">
              Posted on {new Date(post.created_at).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
              })}
            </p>
            <p className="text-gray-900 leading-relaxed">{post.content}</p>
            <p className="mt-4 text-sm text-gray-500">Comments: {post.comments_count}</p>
          </div>
        ))}
      </div>

      <Pagination links={posts.links} />
    </div>
  );
};

export default BlogIndex;
