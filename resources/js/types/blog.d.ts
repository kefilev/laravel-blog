export type User = {
    name: string
}

export type Comment = {
    id: number,
    user_id: number,
    post_id: number,
    parent_id: number,
    body: string,
    is_approved: boolean,
    user: User
};

export type Post = {
    id: number,
    slug: string,
    title: string,
    content: string,
    comments_count: string,
    comments: Array<Comment>
    created_at: string
};

export type PaginationLink = {
    url: string | null,
    label: string,
    active: boolean
}

export type PostsObj = {
    data: Array<Post>
    links: Array<PaginationLink>
}

export type BlogProps = {
    posts: PostsObj
};

type PostProps = {
    post: Post,
}