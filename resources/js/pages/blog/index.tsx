import React from 'react';
import { Link } from '@inertiajs/react';
import Pagination from '@/components/pagination';

type Post = {
  id: number,
  title: string,
  content: string
};

type Link = {
  url: string | null,
  label: string,
  active: boolean
}

type PostsObj = {
  data: Array<Post>
  links: Array<Link>
}

type BlogProps = {
  posts: PostsObj
};

const BlogIndex = ({ posts }: BlogProps) => {
  console.log(posts);

  return (
    <div className="max-w-3xl mx-auto px-4 py-10">
      <h1 className="text-3xl font-bold mb-8 text-center">Blog Posts</h1>

      <div className="space-y-10">
        {posts.data.map((post) => (
          <div
            key={post.id}
            className="bg-white rounded-2xl shadow p-6 border border-gray-200"
          >
            <h2 className="text-2xl font-semibold text-gray-800 mb-2">
              {post.title}
            </h2>
            <p className="text-gray-600 leading-relaxed">{post.content}</p>
          </div>
        ))}
      </div>

      <Pagination links={posts.links} />
    </div>
  );
};

export default BlogIndex;
