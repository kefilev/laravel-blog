export type Post = {
    id: number,
    slug: string,
    title: string,
    content: string,
    comments_count: string,
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

type PostResponse = {
    post: Post,
}